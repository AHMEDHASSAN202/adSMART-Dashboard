import { InertiaLink } from '@inertiajs/inertia-react'

export default function Topbar({children, title, breadcrumb=[]})  {

    const BreadcrumbRender = () => {
        if (!breadcrumb.length) {
            return '';
        }
        return (
            <ul className="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                {breadcrumb.map((bread, i) => {
                    return (
                        <li className="breadcrumb-item" key={i}>
                            <InertiaLink className="text-muted" href={bread.href}>{bread.title}</InertiaLink>
                        </li>
                    );
                })}
            </ul>
        );
    }

    return (

        <div className="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
            <div className=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

                <div className="d-flex align-items-center flex-wrap mr-2">
                    <h5 className="text-dark font-weight-bold mt-2 mb-2 mr-5">{title}</h5>
                    <div className="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <BreadcrumbRender />
                </div>

                <div className="d-flex align-items-center">
                    {children}
                </div>
            </div>
        </div>
    );
}
