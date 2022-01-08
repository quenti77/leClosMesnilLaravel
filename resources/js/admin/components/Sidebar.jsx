import { Component } from 'react'

import SidebarLink from '@adminComponent/SidebarLink.jsx'

export default class Sidebar extends Component {

    constructor (props) {
        super(props)
    }

    closeSidebar () {
        window.Codebase._uiApiLayout('sidebar_close')
    }

    sidebarHeader () {
        return (
            <div className="content-header justify-content-lg-center">
                <div>
                    <a className="link-fx fw-bold tracking-wide fs-lg"
                        href="/">
                        <span className="fs-4 text-dual">Le &nbsp;</span>
                        <span className="fs-4 text-elegance">Clos</span>
                        <span className="fs-4 text-primary">Mesnil</span>
                    </a>
                </div>

                <div>
                    <button type="button"
                            className="btn btn-sm btn-alt-danger d-lg-none"
                            onClick={this.closeSidebar}>
                        <i className="fa fa-fw fa-times"></i>
                    </button>
                </div>
            </div>
        )
    }

    sidebarContainer () {
        return (
            <div className="js-sidebar-scroll">
                <div className="content-side content-side-full">
                    <ul className="nav-main">
                        {this.sidebarMenu()}
                    </ul>
                </div>
            </div>
        )
    }

    sidebarMenu () {
        return (
            <>
            <SidebarLink to="/admin" icon="fa fa-house-user">
                Dashboard
            </SidebarLink>
            <SidebarLink to="/admin/blog" icon="fa fa-book">
                Blog
            </SidebarLink>
            </>
        )
    }

    render () {
        return (
            <nav id="sidebar">
                <div className="sidebar-content">
                    {this.sidebarHeader()}
                    {this.sidebarContainer()}
                </div>
            </nav>
        )
    }

}
