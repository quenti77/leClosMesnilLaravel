
import React from 'react'
import ReactDom from 'react-dom'
import { Provider } from 'react-redux'
import { BrowserRouter } from 'react-router-dom'

import AdminApp from './admin/app.jsx'

import store from './admin/stores/main.js'

ReactDom.render(
    <React.StrictMode>
        <Provider store={store}>
            <BrowserRouter>
                <AdminApp />
            </BrowserRouter>
        </Provider>
    </React.StrictMode>,
    document.getElementById('page-container')
)
