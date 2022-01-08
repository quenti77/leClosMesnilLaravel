import { Component } from 'react'
import { createLink, withUpdateBreadcrumb } from '../stores/Breadcrumb'

class Blog extends Component {

    constructor (props) {
        super(props)
    }

    componentDidMount () {
        this.props.updateBreadcrumb(
            createLink('/admin/blog', 'Blog', false)
        )
    }

    render () {
        return (
            <div className="content">
                <h2 className="content-heading">
                    Blog
                </h2>
                <p>
                    Create your own awesome project!
                </p>
            </div>
        )
    }
}

export default withUpdateBreadcrumb(Blog)
