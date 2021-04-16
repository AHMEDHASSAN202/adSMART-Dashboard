const EditIconButton = ({...props}) => {
    return (
        <button className="btn btn-icon btn-sm btn-secondary" data-toggle="tooltip" title={translations['edit']} {...props}>
            <span className="flaticon2-edit"></span>
        </button>
    );
}

export default EditIconButton;
