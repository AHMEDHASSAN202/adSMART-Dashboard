
const InvalidFeedBack = ({msg=''}) => {
    if (!msg) {
        return '';
    }
    return (
        <div className="invalid-feedback"><strong>{msg}</strong></div>
    );
}

export default InvalidFeedBack;
