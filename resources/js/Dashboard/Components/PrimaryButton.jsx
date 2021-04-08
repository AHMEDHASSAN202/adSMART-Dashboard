
const PrimaryButton = ({children, classes='', ...rest}) => {
    return (
        <button {...rest} className={'btn btn-dark font-weight-bolder text-uppercase ' + classes}>{children}</button>
    )
}

export default PrimaryButton;
