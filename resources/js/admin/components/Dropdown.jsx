import { Component } from 'react'

import { Dropdown as BDropdown } from 'bootstrap'

export default class Dropdown extends Component {

    constructor (props) {
        super(props)
        this.bootstrapDropdown = null
    }

    componentDidMount () {
        if (this.bootstrapDropdown) {
            return undefined
        }
        this.bootstrapDropdown = new BDropdown(
            document.getElementById(this.props.id).parentNode
        )
    }

    componentWillUnmount () {
        if (this.bootstrapDropdown === null) {
            return undefined
        }
        this.bootstrapDropdown.dispose()
        this.bootstrapDropdown = null
    }

    render () {
        return (
            <div className="dropdown d-inline-block">
                <button type="button"
                        id={this.props.id}
                        className="btn btn-sm btn-alt-secondary"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    {this.props.button}
                </button>

                <div className="dropdown-menu dropdown-menu-md dropdown-menu-end p-0"
                     aria-labelledby={this.props.id}>
                    {this.props.children}
                </div>
            </div>
        )
    }

}
