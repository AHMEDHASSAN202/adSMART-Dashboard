import { InertiaLink } from '@inertiajs/inertia-react'

const EditButton = ({href, ...props}) => {
    return (
        <InertiaLink type="button" as="button" href={href} className="btn btn-icon btn-sm btn-secondary" data-toggle="tooltip" title={translations['edit']} {...props}>
            <span className="flaticon2-edit"></span>
        </InertiaLink>
    );
}

export default EditButton;
