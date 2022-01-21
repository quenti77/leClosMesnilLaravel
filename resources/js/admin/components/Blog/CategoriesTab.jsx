import { Component } from 'react'

class CategoriesTab extends Component
{
    constructor (props) {
        super(props)
    }

    rowClickHandler (el) {
        console.log(el)
    }
   
    render () {
        return (
            <div className="tab-pane active">
                <h3 className="fw-normal">Liste des catégories</h3>
                WIP
            </div>
        )
    }
}

export default CategoriesTab
