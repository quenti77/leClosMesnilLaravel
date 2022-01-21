import { Component } from 'react'

class Paginator extends Component {

    constructor (props) {
        super(props)
    }

    generateArray () {
        const { current, max } = this.props
        const distance = 2
        const intervalMin = current - distance
        const intervalMax = current + distance

        const tab = []
        let jump = false

        for (let i = 1; i <= max; i += 1) {
            if (!jump && (i < intervalMin || i > intervalMax)) {
                jump = true
                tab.push({label: '...', active: false})
            }
            if (i >= intervalMin && i <= intervalMax) {
                jump = false
                tab.push({label: i, active: i === current})
            }
        }

        return {
            first: current === 1,
            last: current === max,
            tab
        }
    }

    goTo (page) {
        if (page < 1 || page > this.props.max || page === this.props.current) {
            return undefined
        }
        this.props.onPageChange(page)
    }

    render () {
        const paginations = this.generateArray()

        const pages = paginations.tab.map((t, i) => {
            const disableClass = t.label === '...' ? 'd-none d-sm-inline-block' : ''
            const action = t.active || t.label === '...'
                ? () => {}
                : () => this.goTo(t.label)

            return (
                <li key={i} className={`${disableClass} page-item ${t.active ? 'active' : ''}`}
                    onClick={action}>
                    <span className="page-link">
                        {t.label}
                    </span>
                </li>
            )
        })

        return (
            <ul className="pagination">
                <li className={`d-none d-sm-inline-block page-item first ${paginations.first ? 'disabled' : ''}`}
                    onClick={() => this.goTo(1)}>
                    <span className="page-link">
                        <i className="fa fa-angle-double-left"></i>
                    </span>
                </li>
                <li className={`page-item previous ${paginations.first ? 'disabled' : ''}`}
                    onClick={() => this.goTo(this.props.current - 1)}>
                    <span className="page-link">
                        <i className="fa fa-angle-left"></i>
                    </span>
                </li>
                {pages}
                <li className={`page-item next ${paginations.last ? 'disabled' : ''}`}
                    onClick={() => this.goTo(this.props.current + 1)}>
                    <span className="page-link">
                        <i className="fa fa-angle-right"></i>
                    </span>
                </li>
                <li className={`d-none d-sm-inline-block page-item last ${paginations.last ? 'disabled' : ''}`}
                    onClick={() => this.goTo(this.props.max)}>
                    <span className="page-link">
                        <i className="fa fa-angle-double-right"></i>
                    </span>
                </li>
            </ul>
        )
    }

}

Paginator.defaultProps = {
    onPageChange: () => {}
}

export default Paginator
