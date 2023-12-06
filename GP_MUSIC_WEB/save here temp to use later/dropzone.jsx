import Image from "next/image"
import { useCallback, useState } from "react"
import { useDropzone } from "react-dropzone"
import { ArrowUpTrayIcon, XMarkIcon } from "@heroicons/react/24/solid"

const Dropzone = ({className}) => {
    const [files, setFiles] = useState([])
    
    const onDrop = useCallback(acceptedFiles => {
        if(acceptedFiles?.length){
            setFiles(previousFiles => [
                ...previousFiles,
                ...acceptedFiles.map(file =>
                    Object.assign(file, {preview: URL.createObjectURL(file)}))
            ])
        } [File {path: '', name: '', lastModified: }]
    },[])

    const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop, accept: {
        'image/*': []
    } })

    const removeFile = (name) => {
        setFiles(files => files.filter(file => file.name !== name))
    }
    return (
        <form>
            <div {...getRootProps({
                className : className
            })}
            >
                <input {...getInputProps}/>
                {isDragActive ? (
                    <p>Drop the files here ...</p>
                ):(
                    <p>Drag and drop files here, or click to select files</p>
                )}
            </div>
            
            {/*Accepted files*/}
            <h3 className="title text-lg font-semibold text-neutral-600 mt-10 border-bold">
                Accepted Files
            </h3>
            <ul className="mt-6 grid-cols-3 md:grid-cols-4 xl:grid-cols-12 gap-10">
                {files.map(file =>(
                    <li key={file.name} className="relative h-32 rounded-md shadow-lg">
                        <Image
                            src = {file.preview}
                            alt = {file.name}
                            width = {100}
                            height = {100}
                            onLoad = {() => {
                                URL.revokeObjectURL(file.preview)
                            }}
                            className = "h-full w-full object-cover rounded-md"
                    />
                    <button 
                        type ="button"
                        className="w-7 h-7 border-secondary-400 bg-secondary-400 "
                        onClick={() => removeFile(file.name)}
                        >
                            <XMarkIcon className = "w-5 h-5 fill-white hover:fill-secondary-400"></XMarkIcon>
                    </button>
                        <p className="mt-2 text-neutral-500 text-[12px] font-medium">
                            {file.name}
                        </p>
                    </li>
                ))}
            </ul>
            {/* Preview */}

            <ul>
                {files=map(file => (
                    <li key={file.name}>{file.name}</li>
                ))}
            </ul>
        </form>
    )
}

export default Dropzone