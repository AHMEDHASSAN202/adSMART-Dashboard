
const InvalidFeedBack = ({msg=''}) => {
    if (!msg) {
        return '';
    }
    return (
        <div className="invalid-feedback" style={{display: 'block'}}><strong>{msg}</strong></div>
    );
}

export default InvalidFeedBack;
