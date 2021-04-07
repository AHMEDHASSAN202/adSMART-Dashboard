
const PrimaryButton = ({children, ...rest}) => {
    return (
        <button {...rest} className="btn btn-sm btn-dark font-weight-bolder py-2 px-5">{children}</button>
    )
}

export default PrimaryButton;
