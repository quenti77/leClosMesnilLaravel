import axios from 'axios'

import { Component } from 'react'
import { createLink, withUpdateBreadcrumb } from '../stores/Breadcrumb.js'

import Tabs from '@adminComponent/UI/Tabs.jsx'

import PostsTab from '@adminComponent/Blog/PostsTab.jsx'
import CategoriesTab from '@adminComponent/Blog/CategoriesTab.jsx'

class Blog extends Component {

    constructor (props) {
        super(props)

        const posts = []
        const settingsPosts = {
            currentPage: 1,
            maxPage: 1,
            perPage: 10,
            sorters: ['-updated'],
            titleFilter: null,
            publishFilter: null
        }

        const categories = []
        const settingsCategories = {
            currentPage: 1,
            maxPage: 1,
            perPage: 10
        }

        this.state = {
            posts,
            settingsPosts,
            categories,
            settingsCategories,
            tabs: {
                posts: { component: (
                    <PostsTab posts={posts}
                              settings={settingsPosts}
                              updateSettings={(s) => this.updatePostsSettings(s)} />
                ), label: 'Articles' },
                categories: { component: (
                    <CategoriesTab posts={categories}
                                   settings={settingsCategories}
                                   updateSettings={(s) => this.updateCategoriesSettings(s)} />
                ), label: 'Catégories' }
            }
        }
    }

    componentDidMount () {
        this.props.updateBreadcrumb(
            createLink('/admin/blog', 'Blog', false)
        )

        this.fetchData().then(() => {})
    }

    async fetchData () {
        const { settingsPosts, settingsCategories } = this.state

        let params = {
            page: settingsPosts.currentPage,
            perPage: settingsPosts.perPage,
            sorters: settingsPosts.sorters.join(',')
        }
        const postsResponse = await axios.get('/admin/api/posts', { params })

        const categories = []

        this.setState(() => {
            const { data: posts, meta: { pagination: postsPagination } } = postsResponse.data
            return {
                posts,
                settingsPosts: {
                    ...settingsPosts,
                    currentPage: postsPagination.current_page,
                    maxPage: postsPagination.total_pages
                }
            }
        })
        this.updateTabs()
    }

    updatePostsSettings (settings) {
        this.setState(
            () => ({ settingsPosts: settings }),
            () => { this.fetchData().then(() => {}) }
        )
    }

    updateCategoriesSettings (settings) {
        this.setState(
            () => ({ settingsCategories: settings }),
            () => { this.fetchData().then(() => {}) }
        )
    }

    updateTabs () {
        this.setState((state) => {
            return {
                tabs: {
                    posts: { component: (
                        <PostsTab posts={state.posts}
                                  settings={state.settingsPosts}
                                  updateSettings={(s) => this.updatePostsSettings(s)} />
                    ), label: 'Articles' },
                    categories: { component: (
                        <CategoriesTab categories={state.categories}
                                       settings={state.settingsCategories}
                                       updateSettings={(s) => this.updateCategoriesSettings(s)} />
                    ), label: 'Catégories' }
                }
            }
        })
    }

    render () {
        return (
            <div className="content">
                <h2 className="content-heading">
                    Gestion du blog
                </h2>
                <Tabs tabs={this.state.tabs} />
            </div>
        )
    }
}

export default withUpdateBreadcrumb(Blog)
