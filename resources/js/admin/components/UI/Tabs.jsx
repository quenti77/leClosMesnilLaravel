import { Component } from 'react'

class Tabs extends Component {

    constructor (props) {
        super(props)

        this.state = {
            current: Object.keys(props.tabs)[0]
        }
    }

    changeActiveTab (e, newTab) {
        e.preventDefault()

        this.setState({ current: newTab })
    }

    getCurrentComponent () {
        return this.props.tabs[this.state.current]?.component ?? <span>Unknown</span>
    }

    render () {
        const tabs = Object.entries(this.props.tabs).map(([key, tab]) => {
            const btnClass = ['nav-link']
            if (key === this.state.current) {
                btnClass.push('active')
            }

            return (
                <li className="nav-item" key={key}
                    onClick={(e) => this.changeActiveTab(e, key)}>
                    <button className={btnClass.join(' ')} role={'tab'}>
                        {tab.label}
                    </button>
                </li>
            )
        })

        return (
            <div className="block">
                <ul className="nav nav-tabs nav-tabs-alt" role={'tablist'}>
                    {tabs}
                </ul>
                <div className="block-content block-content-full tab-content">
                    {this.getCurrentComponent()}
                </div>
            </div>
        )
    }

}

export default Tabs
