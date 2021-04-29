const DeleteIconButton = ({...props}) => {
    return (
        <button className="btn btn-icon btn-sm btn-danger" data-toggle="tooltip" title={translations['delete']} {...props}>
            <span className="flaticon2-rubbish-bin-delete-button"></span>
        </button>
    );
}

export default DeleteIconButton;
