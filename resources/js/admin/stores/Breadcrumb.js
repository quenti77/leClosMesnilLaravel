import { connect } from "react-redux"

const baseLinks = [
    { external: true, to: '/', label: 'Le ClosMesnil' },
    { external: false, to: '/admin', label: 'Dashboard' }
]

// Selectors
export const breadcrumbSelector = ({ breadcrumb }) => breadcrumb

// Names actions
export const SET_BREADCRUMB_ACTION = 'SET_BREADCRUMB_ACTION'

// Actions
export const updateBreadcrumbAction = (links) => ({
    type: SET_BREADCRUMB_ACTION,
    payload: links
})

export function breadcrumbReducer (state = baseLinks, action) {
    switch (action.type) {
        case SET_BREADCRUMB_ACTION:
            return [
                ...baseLinks,
                ...action.payload
            ]
        default:
            return state
    }
}

export function createLink (to, label, external) {
    return {to, label, external}
}

export function withUpdateBreadcrumb(Page) {
    const mapActions = (dispatch) => ({
        updateBreadcrumb: (...links) => dispatch(updateBreadcrumbAction(links))
    })

    return connect(null, mapActions)(Page)
}
