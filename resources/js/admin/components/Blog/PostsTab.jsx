import { Component } from 'react'

import Paginator from '@adminComponent/UI/Paginator.jsx'
import Datatable from '@adminComponent/UI/Datatable.jsx'

import * as config from '../../configs/Blog/Posts'

class PostsTab extends Component
{
    constructor (props) {
        super(props)
    }

    rowClickHandler (el) {
        console.log(el)
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

    renderAction (item, key) {
        return (
            <td data-col="action" key={key}>
                <div className="btn-group">
                    <button type="button" className="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                            data-bs-toggle="tooltip" title="" data-bs-original-title="Edit"
                            onClick={() => this.rowClickHandler(item)}>
                        <i className="fa fa-pencil-alt"></i>
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
                <h3 className="fw-normal">Liste des articles</h3>
                {this.renderPaginateTable()}
            </div>
        )
    }
}

export default PostsTab
