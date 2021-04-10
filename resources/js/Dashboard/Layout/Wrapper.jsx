export default function Wrapper({children}) {
    return (
        <div className="content  d-flex flex-column flex-column-fluid" id="kt_content">
            <div className="d-flex flex-column-fluid">
                <div className="container">
                    {children}
                </div>
            </div>
        </div>
    );
}
