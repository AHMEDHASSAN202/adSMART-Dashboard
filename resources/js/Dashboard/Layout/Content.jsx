import Alert from './../Components/Alert';

const Content = ({children}) => {
    return (
        <div className='d-flex flex-column-fluid'>
            <div className='container'>
                <div className='row d-block'>
                    <Alert/>
                    {children}
                </div>
            </div>
        </div>
    );
}


export default Content;
