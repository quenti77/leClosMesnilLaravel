import { Children, Component } from 'react'

class Modal extends Component {

    constructor(props) {
        super(props)
    }

    getClasses() {
        const base = ['modal', 'fade']

        let backdrop = document.querySelector('.modal-backdrop')
        if (this.props.visible) {
            base.push('show')
            document.body.classList.add('modal-open')

            if (backdrop === null) {
                backdrop = document.createElement('div')
                backdrop.classList.add('modal-backdrop', 'fade', 'show')
                backdrop.addEventListener('click', this.props.close)
                document.body.appendChild(backdrop)
            }
        } else {
            document.body.classList.remove('modal-open')

            if (backdrop) {
                backdrop.removeEventListener('click', this.props.close)
                backdrop.remove()
            }
        }

        return base.join(' ')
    }

    renderHeader() {
        return (
            <div className="block-header block-header-default">
                <h3 className="block-title">
                    {this.props.title}
                </h3>
                <div className="block-options">
                    <button type="button" className="btn-block-option" aria-label="Close"
                            onClick={this.props.close}>
                        <i className="fa fa-times"></i>
                    </button>
                </div>
            </div>
        )
    }

    renderActions() {
        return (
            <div className="block-content block-content-full d-flex justify-content-end block-content-sm border-top">
                <button type="button" className="btn btn-alt-secondary" onClick={this.props.close}>
                    Fermer
                </button>
                {this.props.actions}
            </div>
        )
    }

    render() {
        const style = {
            display: this.props.visible ? 'block' : 'none'
        }

        let dialogClass = "modal-dialog"
        if ('size' in this.props) {
            dialogClass += ' modal-' + this.props.size
        }

        return (
            <div className={this.getClasses()} tabIndex="-1" style={style}>
                <div className={dialogClass} role="document">
                    <div className="modal-content">
                        <div className="block block-rounded shadow-none mb-0">
                            {this.renderHeader()}
                            <div className="block-content fs-sm px-4 py-4">
                                {this.props.children}
                            </div>
                            {this.renderActions()}
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

Modal.defaultProps = {
    visible: false,
    title: 'Modal',
    close: () => {},
    content: (<div></div>),
    actions: (<div></div>)
}

export default Modal
