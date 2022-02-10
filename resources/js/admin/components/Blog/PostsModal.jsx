import { useEffect, useState } from 'react'
import { useForm } from 'react-hook-form'

import Modal from '@adminComponent/UI/Modal.jsx'

import { EMPTY_UUID, slugify } from '../../configs/Blog/Base'

async function getCategories() {
    const { data: response } = await axios.get('/admin/api/categories', {
        pagination: 0
    })
    return response.data
}

function categoryOption(c) {
    return (
        <option key={c.id} value={c.id}>
            {c.name}
        </option>
    )
}

function loadForm(setF, post) {
    return async function () {
        const categories = await getCategories()
        setF({
            title: post.title,
            slug: post.slug,
            content: post.content,
            categories,
            category: post.category?.id ?? categories[0]?.id ?? '',
            publish: post.publish
        })
    }
}

function contentCheckbox(published) {
    if (published) {
        return (
            <span className="d-flex align-items-center">
                <span>
                    <span className="fw-bold fs-lg">
                        Masquer l'article
                    </span>
                    <span className="d-block fs-xs text-muted mt-2">
                        Si l'article n'a plus lieu d'être vous pouvez le dépublier et
                        il ne sera plus visible pour vos visiteurs
                    </span>
                </span>
            </span>
        )
    }
    return (
        <span className="d-flex align-items-center">
            <span>
                <span className="fw-bold fs-lg">
                    Publier l'article
                </span>
                <span className="d-block fs-xs text-muted mt-2">
                    Activer l'option permet de rendre l'article visible par tous les visiteurs du site.<br />
                    Vous pourrez toujours modifier l'article mais attention car
                    tous les changement seront visible par vos visiteurs.
                </span>
            </span>
        </span>
    )
}

function PostsModal({ post, visible, update, closeModal }) {
    const [f, setF] = useState({})
    const [editableSlug, setEditableSlug] = useState(false)

    useEffect(loadForm(setF, post), [post])

    const { register, handleSubmit, reset, getValues } = useForm()
    
    useEffect(() => {
        reset(f)
        setEditableSlug(false)
    }, [f])

    const categoriesOptions = f?.categories?.map(categoryOption) ?? (<></>)

    const saveTitle = post.id === EMPTY_UUID ? "Création d'un article" : "Modification de l'article"
    const saveWord = post.id === EMPTY_UUID ? 'Créer' : 'Enregistrer'
    const classBtn = post.id === EMPTY_UUID ? 'success' : 'warning'
    const actions = (
        <button type="button" className={`btn btn-${classBtn} ms-2`}
                onClick={handleSubmit((data) => update({ ...data, id: post.id }))}>
            {saveWord}
        </button>
    )

    const handlePublishedChanged = (e) => {
        setF({
            ...getValues(),
            publish: e.target.checked
        })
    }
    const handleTitleBlur = (e) => {
        if (editableSlug) {
            return undefined
        }
        setF({
            ...getValues(),
            slug: slugify(e.target.value)
        })
    }

    const titleRegister = register('title')
    const { onBlur } = titleRegister
    titleRegister.onBlur = (e) => {
        handleTitleBlur(e)
        onBlur(e)
    }

    return (
        <Modal size="lg"
               visible={visible}
               title={saveTitle}
               actions={actions}
               close={closeModal}>
            <form className="row editPost">
                <div className="col-xs-12 mb-3">
                    <label className="form-label">Catégorie</label>
                    <select className="form-select" {...register('category')}>
                        {categoriesOptions}
                    </select>
                </div>
                <div className="col-xs-12 mb-3">
                    <label className="form-label">Titre</label>
                    <input type="text" className="form-control" { ...titleRegister } />
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
                <div className="col-xs-12 mb-4">
                    <label className="form-label">Contenu</label>
                    <textarea className="form-control" { ...register('content') } rows={7}></textarea>
                </div>
                <div className="col-xs-12">
                    <div className="form-check form-block">
                        <input type="checkbox" id="publishedModalEl" onInput={handlePublishedChanged}
                               className="form-check-input" { ...register('publish') } />
                        <label htmlFor="publishedModalEl" className="form-check-label">
                            {contentCheckbox(f.publish)}
                        </label>
                    </div>
                </div>
            </form>
        </Modal>
    )
}

export default PostsModal
