import { Component } from 'react'
import { withUpdateBreadcrumb } from '../stores/Breadcrumb'

class Dashboard extends Component {

    constructor (props) {
        super(props)
    }

    componentDidMount () {
        this.props.updateBreadcrumb()
    }

    render () {
        return (
            <div className="content">
                <h2 className="content-heading">
                    Dashboard
                </h2>
                <p>
                    Create your own awesome project!
                </p>
            </div>
        )
    }
}

export default withUpdateBreadcrumb(Dashboard)
