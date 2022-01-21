import { Component } from 'react'

const MODE_SORT = {
    '+': 'asc',
    '-': 'desc'
}

export const isPrimitive = function (val) {
    return Object(val) !== val
}

class Datatable extends Component {

    constructor (props) {
        super(props)

        this.tableClasses = this.props.className.split(' ')
        const sorters = this.props.sorters.map((s) => {
            return [
                s.substring(1),
                MODE_SORT[s.substring(0, 1)] ?? null
            ]
        })
        this.currentSorters = Object.fromEntries(sorters)
        console.log(this.currentSorters)
    }

    rowClickHandler (item) {
        this.props.onRowClick(item)
    }

    updateSorters (columnKey) {
        Object.entries(this.currentSorters).forEach(([key, _]) => {
            if (key === columnKey) {
                return undefined
            }
            delete this.currentSorters[key]
        })

        if (!(columnKey in this.currentSorters)) {
            this.currentSorters[columnKey] = 'asc'
        } else if (this.currentSorters[columnKey] === 'asc') {
            this.currentSorters[columnKey] = 'desc'
        } else {
            delete this.currentSorters[columnKey]
        }

        const sorters = Object.entries(this.currentSorters).map(([key, value]) => {
            const direction = value === 'desc' ? '-' : '+'
            return `${direction}${key}`
        })
        this.props.updateSorters(sorters)
        
    }

    getTableHead () {
        return this.props.columns.map((column) => {
            const columnKey = column.key
            const classes = column.classes.split(' ').filter(e => e.trim() !== '')
            
            const sortActivated = column.sort ?? true
            if (sortActivated) {
                const modeSort = this.currentSorters[columnKey] ?? null
                classes.push('sorting')
                if (modeSort !== null) {
                    classes.push(`sorting_${modeSort}`)
                }
            } else {
                classes.push('sorting_disabled')
            }

            return (
                <th data-col={columnKey} key={columnKey}
                    className={classes.join(' ')}
                    onClick={() => sortActivated && this.updateSorters(columnKey)}>
                    {column.label}
                </th>
            )
        })
    }

    getTableRow (item, i) {
        const columns = this.props.columns.map(({ key, classes }) => {
            if (key in this.props) {
                return this.props[key](item, key)
            }

            return (
                <td data-col={key} key={key}
                    className={classes}>
                    {isPrimitive(item[key]) ? item[key] : JSON.stringify(item[key])}
                </td>
            )
        })

        return (
            <tr key={i} onClick={() => this.rowClickHandler(item)}>
                {columns}
            </tr>
        )
    }

    render () {
        let rows = this.props.items.map((item, i) => this.getTableRow(item, i))
        if (rows.length === 0) {
            rows = (
                <tr>
                    <td className="text-center" colSpan={this.props.columns.length}>
                        Aucun enregistrement à afficher
                    </td>
                </tr>
            )
        }

        return (
            <table className={['table', 'dataTable', ...this.tableClasses].join(' ')}>
                <thead>
                    <tr>
                        {this.getTableHead()}
                    </tr>
                </thead>
                <tbody>
                    {rows}
                </tbody>
            </table>
        )
    }

}

Datatable.defaultProps = {
    onRowClick: () => {},
    updateSorters: () => {}
}

export default Datatable
