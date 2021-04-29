import { Scrollbars } from 'react-custom-scrollbars-2';
import {useEffect, useRef} from "react";

const Scroll = ({height=300, backgroundColor='#F3F6F9', children, autoBottom=false, ...props}) => {
    const scrollbar = useRef(null);

    useEffect(() => {
        if (autoBottom) {
            scrollbar.current.scrollToBottom()
        }
    });

    const RenderThumbY = ({ style, ...props }) => {
        const thumbStyle = {
            borderRadius: 6,
            backgroundColor: backgroundColor
        };
        return <div style={{ ...style, ...thumbStyle }} {...props} />;
    };

    return (
        <Scrollbars
            ref={scrollbar}
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
