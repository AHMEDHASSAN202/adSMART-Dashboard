import Moment from 'react-moment';
import 'moment-timezone';

const MomentComponent = ({children, ...props}) => {
    return (<Moment local {...props}>{children}</Moment>);
}

export default MomentComponent;
