import { InertiaLink } from '@inertiajs/inertia-react'

const AddButton = ({href, ...props}) => {
    return (
        <InertiaLink href={href} {...props} className='btn btn-dark font-weight-bolder text-uppercase'>
            <i className='icon-md flaticon2-add' style={{marginRight: 3, marginBottom: 2}}></i>
            {translations['add_new']}
        </InertiaLink>
    );
}


export default AddButton;
