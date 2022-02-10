import { useEffect, useState } from 'react'
import { useForm } from 'react-hook-form'

import Modal from '@adminComponent/UI/Modal.jsx'

import { EMPTY_UUID, slugify } from '../../configs/Blog/Base'

function modalOptions(category) {
    const empty = category.id === EMPTY_UUID

    return {
        title: empty ? "Création d'une catégorie" : "Modification de la catégorie",
        btnContent: empty ? 'Ajouter' : 'Modifier',
        btnClass: empty ? 'success' : 'warning'
    }
}

function CategoriesModal({ category, visible, update, closeModal }) {
    const [f, setF] = useState({})
    const [editableSlug, setEditableSlug] = useState(false)

    useEffect(() => {
        setF({
            name: category.name,
            slug: category.slug
        })
    }, [category])

    const { register, handleSubmit, reset, getValues } = useForm()

    useEffect(() => {
        reset(f)
        setEditableSlug(false)
    }, [f])

    const { title, btnContent, btnClass } = modalOptions(category)

    const actions = (
        <button type="button" className={`btn btn-${btnClass} ms-2`}
                onClick={handleSubmit((data) => update({ ...data, id: category.id }))}>
            {btnContent}
        </button>
    )

    const handleNameBlur = (e) => {
        if (editableSlug) {
            return undefined
        }
        setF({
            ...getValues(),
            slug: slugify(e.target.value)
        })
    }

    const nameRegister = register('name')
    const { onBlur } = nameRegister
    nameRegister.onBlur = (e) => {
        handleNameBlur(e)
        onBlur(e)
    }
    
    return (
        <Modal visible={visible}
               title={title}
               actions={actions}
               close={closeModal}>
            <form className="row editCategory">
                <div className="col-xs-12 mb-3">
                    <label className="form-label">Titre</label>
                    <input type="text" className="form-control" { ...nameRegister } />
                </div>
                <div className="col-xs-12 mb-3">
                    <label className="form-label">Slug</label>
                    <div className="input-group">    
                        <input type="text" className="form-control" { ...register('slug') } disabled={!editableSlug} />
                        <button type="button" className={`btn btn-${editableSlug ? 'primary' : 'alt-secondary'}`}
                                onClick={() => setEditableSlug(!editableSlug)}>
                            <i className={`fa fa-${editableSlug ? 'pen' : 'lock'}`}></i>
                        </button>
                    </div>
                </div>
            </form>
        </Modal>
    )
}

export default CategoriesModal
