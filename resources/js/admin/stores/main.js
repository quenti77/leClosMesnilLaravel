import { createStore, combineReducers } from 'redux'

import { breadcrumbReducer } from './Breadcrumb.js'

export default createStore(
    combineReducers({
        breadcrumb: breadcrumbReducer
    }),
    window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
)
