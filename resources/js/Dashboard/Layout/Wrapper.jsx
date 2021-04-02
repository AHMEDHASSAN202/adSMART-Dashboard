import react from 'react';
import Header from './Header';
import ProfileInfoPanel from './../Components/ProfileInfoPanel';
import NotificationPanel from './../Components/NotificationPanel';

export default function Wrapper({children}) {
    return (
        <div className="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

            <Header />

            <ProfileInfoPanel />

            <NotificationPanel />

            <div className="content  d-flex flex-column flex-column-fluid" id="kt_content">
                <div className="d-flex flex-column-fluid">
                    <div className="container">
                        {children}
                    </div>
                </div>
            </div>

            {/*<Footer />*/}
        </div>
    );
}
