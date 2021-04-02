import Content from "../Layout/Content";
import Layout from "../Layout/Layout";

const ErrorPage = (props) => {
    return (
        <Content>
            <div className="d-flex flex-row-fluid flex-column  bgi-position-center p-10 p-sm-30">
                <h1 className="font-weight-boldest text-dark-75 mt-15" style={{fontSize: '10rem'}}>{props.statusCode}</h1>
                <p className="font-size-h3 text-muted font-weight-normal">
                    {props.message}
                </p>
            </div>
        </Content>
    );
}

ErrorPage.layout = page => <Layout children={page}/>

export default ErrorPage;
