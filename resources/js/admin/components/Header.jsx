import { Component } from 'react'

import Dropdown from '@adminComponent/UI/Dropdown.jsx'

export default class Header extends Component {

    constructor (props) {
        super(props)

        this.toggleSidebar = this.toggleSidebar.bind(this)
    }

    toggleSidebar () {
        window.Codebase._uiApiLayout('sidebar_toggle')
    }

    headerLeft () {
        return (
            <div className="space-x-1">
                <button type="button"
                        className="btn btn-sm btn-alt-secondary"
                        onClick={this.toggleSidebar}>
                    <i className="fa fa-fw fa-bars"></i>
                </button>
            </div>
        )
    }

    headerRight () {
        const { name: firstname, last_name: lastname } = window.Laravel.user
        const shortName = `${firstname.ucwords()} ${lastname[0].toUpperCase()}.`
        const longName = `${firstname.ucwords()} ${lastname.ucwords()}`

        return (
            <div className="space-x-1">
                {this.userDropdown(shortName, longName)}
            </div>
        )
    }

    userDropdown (short, long) {
        const dropdownButton = (
            <>
            <i className="fa fa-user d-sm-none"></i>
            <span className="d-none d-sm-inline-block fw-semibold">
                {short}
            </span>
            <i className="fa fa-angle-down opacity-50 ms-1"></i>
            </>
        )

        return (
            <Dropdown id="page-header-user-dropdown" button={dropdownButton}>
                <div className="px-2 py-3 bg-body-light rounded-top">
                    <h5 className="h6 text-center mb-0">
                        {long}
                    </h5>
                </div>
                <div className="p-2 cursor-pointer">
                    <a className="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                       href="#">
                        <span>Se déconnecter</span>
                        <i className="fa fa-fw fa-sign-out-alt opacity-25"></i>
                    </a>
                </div>
            </Dropdown>
        )
    }

    render () {
        return (
            <header id="page-header">
                <div className="content-header">
                    {this.headerLeft()}
                    {this.headerRight()}
                </div>
            </header>
        )
    }

}
