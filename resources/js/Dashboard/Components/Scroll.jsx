import { Scrollbars } from 'react-custom-scrollbars-2';


const Scroll = ({height=300, backgroundColor='#F3F6F9', children, ...props}) => {

    const RenderThumbY = ({ style, ...props }) => {
        const thumbStyle = {
            borderRadius: 6,
            backgroundColor: backgroundColor
        };
        return <div style={{ ...style, ...thumbStyle }} {...props} />;
    };
    return (
        <Scrollbars
            renderThumbHorizontal={() => <div style={{display: 'none'}}></div>}
            renderThumbVertical={RenderThumbY}
            style={{ height: height}}
            autoHide
            {...props}
        >
            {children}
        </Scrollbars>
    );
}


export default Scroll;
