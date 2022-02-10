import { EMPTY_UUID } from './Base'

export const datatables = {
    columns: [
        { key: 'title', label: 'Titre', classes: '' },
        { key: 'category', label: 'Catégorie', classes: 'd-none d-sm-table-cell', sort: true },
        { key: 'updated', label: 'Modifié le', classes: 'd-none d-xl-table-cell' },
        { key: 'publish', label: 'Publié ?', classes: 'd-none d-md-table-cell' },
        { key: 'action', label: 'Actions', classes: 'text-center', sort: false }
    ]
}

export function renderPublish(item, key) {
    const label = item.publish
        ? <span className="badge bg-success">Oui</span>
        : <span className="badge bg-danger">Non</span>

    return (
        <td data-col="publish" className="d-none d-md-table-cell" key={key}>
            {label}
        </td>
    )
}

export function renderTitle(item, key) {
    return (
        <td data-col="title" key={key}>
            <span>{item.title}</span>
            <span className="d-inline d-sm-none category">
                <br />
                <em>{item.category.name}</em>
            </span>
        </td>
    )
}

export function renderCategory(item, key) {
    return (
        <td data-col="category" key={key} className="d-none d-sm-table-cell">
            {item.category.name}
        </td>
    )
}

export const basePost = {
    id: EMPTY_UUID,
    title: '',
    slug: '',
    content: '',
    publish: false,
    category: null
}
