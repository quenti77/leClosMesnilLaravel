import { EMPTY_UUID } from './Base'

export const datatables = {
    columns: [
        { key: 'name', label: 'Nom', classes: '' },
        { key: 'updated', label: 'Modifié le', classes: 'd-none d-md-table-cell' },
        { key: 'count', label: 'Nb de posts', classes: 'd-none d-xl-table-cell' },
        { key: 'action', label: 'Actions', classes: 'text-center', sort: false }
    ]
}

export function renderName(item, key) {
    return (
        <td data-col="name" key={key}>
            <span>{item.name}</span><br />
            <small>
                <em>{item.slug}</em>
            </small>
        </td>
    )
}

export const baseCategory = {
    id: EMPTY_UUID,
    title: '',
    slug: ''
}
