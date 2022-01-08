import { useSelector } from 'react-redux'
import { Link } from 'react-router-dom'
import { breadcrumbSelector } from '../stores/Breadcrumb'

function createExternalLink(link, index) {
    return (
        <a href={link.to} className="breadcrumb-item" key={index}>{link.label}</a>
    )
}

function createInternalLink(link, index) {
    return (
        <Link to={link.to} className="breadcrumb-item" key={index}>{link.label}</Link>
    )
}

function createActiveLink(link, index) {
    return (
        <span className="breadcrumb-item active" key={index}>{link.label}</span>
    )
}

export function Breadcrumb() {
    const links = useSelector(breadcrumbSelector)

    const mapLinks = links.map((link, i) => {
        const index = `breadcrum_${i}`
        if (i === links.length - 1) {
            return createActiveLink(link, index)
        }

        return link.external
            ? createExternalLink(link, index)
            : createInternalLink(link, index)
    })

    return (
        <div className="block mt-3 mb-0">
            <div className="block-content my-3 py-0">
                <nav className="breadcrumb push mb-0">
                    {mapLinks}
                </nav>
            </div>
        </div>
    )
}

