import { useResolvedPath, useMatch, Link } from 'react-router-dom';

export default function SidebarLink ({ children, to, icon, ...props }) {
    let resolved = useResolvedPath(to)
    let match = useMatch({ path: resolved.pathname, end: true })

    let classes = (props.className || '').split(' ')
    classes.push('nav-main-link')
    if (match) {
        classes.push('active')
    }

    props.className = classes.join(' ')
    icon = `nav-main-link-icon ${icon}`

    return (
        <li className="nav-main-item">
            <Link to={to}
                  {...props}>
                <i className={icon}></i>
                <span className="nav-main-link-name">
                    {children}
                </span>
            </Link>
        </li>
    )
}
