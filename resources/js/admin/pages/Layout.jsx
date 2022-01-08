import { Component } from 'react'
import { Outlet } from 'react-router-dom'

import Sidebar from '@adminComponent/Sidebar.jsx'
import Header from '@adminComponent/Header.jsx'
import { Breadcrumb } from '@adminComponent/Breadcrumb.jsx'

export default class Layout extends Component {

    constructor (props) {
        super(props)
    }

    render () {
        return (
            <>
            <Sidebar />
            <Header />
            <main id="main-container">
                <Breadcrumb />
                <Outlet />
            </main>
            <footer id="page-footer">
                <div className="content py-3">
                    <div className="row fs-sm">
                        <div className="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                            Crafted with <i className="fa fa-heart text-danger"></i> by &nbsp;
                            <a className="fw-semibold" href="https://github.com/Farcy-Corentin" target="_blank">
                                Corentin Farcy
                            </a>
                        </div>
                        <div className="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                            Theme based on &nbsp;
                            <a className="fw-semibold" href="https://1.envato.market/95j" target="_blank">
                                Codebase
                            </a> &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            </>
        )
    }

}
