import axios from 'axios'
import { Component } from 'react'

import PostsModal from '@adminComponent/Blog/PostsModal.jsx'

import Datatable from '@adminComponent/UI/Datatable.jsx'
import Paginator from '@adminComponent/UI/Paginator.jsx'

import * as config from '../../configs/Blog/Posts'
import { EMPTY_UUID, slugify } from '../../configs/Blog/Base'

function initPostForm (values = {}) {
    return {
        ...config.basePost,
        ...values
    }
}

async function createPost(post) {
    return await axios.post('/admin/api/posts', post)
}

async function updatePost(post) {
    return await axios.patch(`/admin/api/posts/${post.id}`, post)
}

async function deletePost(postId) {
    return await axios.delete(`/admin/api/posts/${postId}`)
}

class PostsTab extends Component
{
    constructor (props) {
        super(props)

        this.state = {
            modal: false,
            modalForm: initPostForm()
        }
    }

    rowClickHandler (el) {
        this.setState(() => {
            return {
                ...this.state,
                modal: true,
                modalForm: initPostForm(el)
            }
        })
    }

    rowDeleteHandler (el) {
        if (!window.confirm('Voulez-vous supprimez l\'article ?')) {
            return undefined
        }
        deletePost(el.id).then(() => {
            this.updateCurrentPage(this.props.settings.currentPage)
        })
    }

    updateCurrentPage (currentPage) {
        this.props.updateSettings({
            ...this.props.settings,
            currentPage: parseInt(currentPage)
        })
    }

    updatePerPage (perPage) {
        this.props.updateSettings({
            ...this.props.settings,
            perPage: parseInt(perPage)
        })
    }

    updateSorters (sorters) {
        this.props.updateSettings({
            ...this.props.settings,
            sorters
        })
    }

    createPost () {
        this.setState(() => {
            return {
                ...this.state,
                modal: true,
                modalForm: initPostForm()
            }
        })
    }

    closeModal () {
        this.setState(() => {
            return {
                ...this.state,
                modal: false
            }
        })
    }

    updatePost (post) {
        delete post.categories

        if (post.slug === '') {
            post.slug = slugify(post.title)
        }

        const promise = (post.id === EMPTY_UUID)
            ? createPost(post)
            : updatePost(post)
        
        promise.then(() => {
            this.updateCurrentPage(this.props.settings.currentPage)
            this.closeModal()
        })
    }

    renderAction (item, key) {
        return (
            <td data-col="action" key={key}>
                <div className="btn-group">
                    <button type="button" className="btn btn-sm btn-secondary"
                            onClick={() => this.rowClickHandler(item)}>
                        <i className="fa fa-pencil-alt"></i>
                    </button>
                    <button type="button" className="btn btn-sm btn-secondary"
                            onClick={() => this.rowDeleteHandler(item)}>
                        <i className="fa fa-trash"></i>
                    </button>
                </div>
            </td>
        )
    }

    renderPaginateTable () {
        return (
            <>
            <div className="row align-items-baseline">
                <div className="col-sm-12 col-md-2">
                    <select name="perPage" className="form-select" value={this.props.settings.perPage}
                            onChange={(e) => this.updatePerPage(e.target.value)}>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
            </div>
            <div className="row my-2">
                <div className="col-12">
                    <Datatable className="table-bordered table-striped table-vcenter posts-table"
                               columns={config.datatables.columns}
                               sorters={this.props.settings.sorters}
                               updateSorters={(sorters) => this.updateSorters(sorters)}
                               items={this.props.posts}
                               title={config.renderTitle}
                               category={config.renderCategory}
                               publish={config.renderPublish}
                               action={this.renderAction.bind(this)} />
                </div>
            </div>
            <div className="row align-items-baseline">
                <div className="col-sm-12 col-md-6 mb-3 d-flex justify-content-center justify-content-md-start">
                    <span>
                        Page <strong>{this.props.settings.currentPage}</strong>
                        &nbsp;of <strong>{this.props.settings.maxPage}</strong>
                    </span>
                </div>
                <div className="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                    <Paginator current={this.props.settings.currentPage}
                               max={this.props.settings.maxPage}
                               onPageChange={(page) => this.updateCurrentPage(page)} />
                </div>
            </div>
            </>
        )
    }

    render () {
        return (
            <div className="tab-pane active">
                <PostsModal post={this.state.modalForm}
                            visible={this.state.modal}
                            closeModal={this.closeModal.bind(this)}
                            update={this.updatePost.bind(this)} />

                <h3 className="fw-normal d-flex justify-content-between align-items-center">
                    <span>Liste des articles</span>
                    <button type="button" className="btn btn-success js-bs-tooltip-enabled"
                            data-bs-toggle="tooltip" title="" data-bs-original-title="Edit"
                            onClick={this.createPost.bind(this)}>
                        <i className="fa fa-plus-circle"></i>
                        <div className="d-inline-block ms-2">
                            Ajouter un article
                        </div>
                    </button>
                </h3>
                {this.renderPaginateTable()}
            </div>
        )
    }
}

export default PostsTab
