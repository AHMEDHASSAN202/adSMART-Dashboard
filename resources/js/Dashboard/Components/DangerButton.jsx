import { InertiaLink } from '@inertiajs/inertia-react'

const DangerButton = ({href, data, ...props}) => {
    return (
        <InertiaLink type="button" as="button" preserveState={false} href={href} className="btn btn-icon btn-sm btn-danger" data-toggle="tooltip" title={translations['delete']} method="delete" data={data} {...props}>
            <span className="flaticon2-rubbish-bin-delete-button"></span>
        </InertiaLink>
    );
}

export default DangerButton;
