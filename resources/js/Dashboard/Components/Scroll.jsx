import { Scrollbars } from 'react-custom-scrollbars-2';
import {useEffect, useRef} from "react";

const Scroll = ({height=300, backgroundColor='#F3F6F9', children, autoBottom=false, ...props}) => {
    const scrollbar = useRef(null);

    useEffect(() => {
        if (autoBottom) {
            scrollbar.current.scrollToBottom()
        }
    });

    if (window.currentLanguage.language_direction == 'rtl') {
        props.renderView = props => (<div {...props} style={{ ...props.style, marginLeft: props.style.marginRight, marginRight: 0, }} /> )
    }

    const RenderThumbY = ({ style, ...props }) => {
        const thumbStyle = {
            borderRadius: 6,
            backgroundColor: backgroundColor
        };
        return <div style={{ ...style, ...thumbStyle }} {...props} />;
    };

    const RenderTrackVertical = ({ style, ...props }) => {
        const myStyle = {
            position: 'absolute',
            width: '6px',
            transition: 'opacity 200ms ease 0s',
            opacity: 0,
            bottom: '2px',
            top: '2px',
            borderRadius: '3px'
        };
        return <div className={'trackVertical'} style={{ ...style, ...myStyle }} {...props} />;
    }

    return (
        <Scrollbars
            ref={scrollbar}
            renderThumbHorizontal={() => <div style={{display: 'none'}}></div>}
            renderThumbVertical={RenderThumbY}
            renderTrackVertical={RenderTrackVertical}
            style={{ height: height}}
            autoHide
            {...props}
        >
            {children}
        </Scrollbars>
    );
}


export default Scroll;
