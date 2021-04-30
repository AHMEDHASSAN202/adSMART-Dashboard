import ImageUploading from "react-images-uploading";

const ChatInputFile = ({images=[], onChange, maxNumber=10}) => {
    return (
        <ImageUploading
            multiple
            value={images}
            onChange={onChange}
            maxNumber={maxNumber}
            dataURLKey="data_url"
        >
            {({
                  imageList,
                  onImageUpload,
                  onImageRemoveAll,
                  onImageUpdate,
                  onImageRemove,
                  isDragging,
                  dragProps
              }) => (
                <button
                    className="btn btn-clean btn-icon btn-md mr-1 mb-0 as-a no-underline-hover"
                    style={isDragging ? { color: "red" } : null}
                    onClick={onImageUpload}
                    {...dragProps}
                >
                    <i className="flaticon2-photograph icon-lg"></i>
                </button>
            )}
        </ImageUploading>
    );
}

export default ChatInputFile;
