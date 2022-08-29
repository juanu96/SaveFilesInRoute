import React, { useContext } from 'react'
import '../Carpetas/Carpetas.scss'
import Popup from '../Popup/Popup';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faUpload, faTrash, faFolder } from '@fortawesome/free-solid-svg-icons';
import { Store } from '../App/App'

export default function Carpetas() {
    const store = useContext(Store)
    return (
        <div className='carpetasContainer'>
            <div className='botonesAccion'>
                <div onClick={() => store.setShowModal(true)} className='buttons nuevoArchivo'>
                    <FontAwesomeIcon icon={faUpload} className="iconButton" /> Añadir nuevo archivo
                </div>
                <div className='buttons'>
                    <FontAwesomeIcon icon={faTrash} className="iconButton" /> Eliminar archivo
                </div>
                <div className='buttons'>
                    <FontAwesomeIcon icon={faFolder} className="iconButton" /> Añadir nueva carpeta
                </div>

            </div>

            <div>
                <Popup />
            </div>

            <div>

            </div>
        </div>
    )
}
