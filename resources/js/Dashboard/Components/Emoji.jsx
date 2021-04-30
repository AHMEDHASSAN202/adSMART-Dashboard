import 'emoji-mart/css/emoji-mart.css'
import { Picker } from 'emoji-mart'

const Emoji = ({onSelect}) => {
    return (
        <span className={'emoji-container'}>
           <Picker onSelect={onSelect} />
        </span>
    )
}

export default Emoji;
