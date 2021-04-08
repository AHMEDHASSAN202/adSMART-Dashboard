import { InertiaLink } from '@inertiajs/inertia-react'

const SubmitButton = ({href, title, ...props}) => {
    return (
        <InertiaLink href={href} {...props} as='button' type='submit' preserveState={false} className='btn btn-dark font-weight-bolder btn-sm px-5 text-uppercase'>
            <i className='icon-md flaticon2-add' style={{marginRight: 3, marginBottom: 2}}></i>
            {title}
        </InertiaLink>
    );
}


export default SubmitButton;
