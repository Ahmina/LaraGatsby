import React, {useState, useEffect} from 'react';
import {dataBaseUrlAPI} from '../data/index'
import axios from 'axios';

const HistoryModal = ({generalIdComment, handleCloseModal}) => {
	document.body.style.overflow = "hidden";
	
	const baseUrlAPI=dataBaseUrlAPI();
	const [historyComments, setHistoryComments]=useState([]);

	useEffect(()=>{
		const keyboradEventListener = (e) =>{
			if(e.key==='Escape'){
				handleCloseModal();	
			}
		}

		window.addEventListener('keydown', keyboradEventListener);

		return () => {
			window.removeEventListener('keydown', keyboradEventListener);
		};

	},[handleCloseModal]);

	useEffect(()=>{
        let mounted=true;
		
		axios.get(`${baseUrlAPI}/historycomments`)
		.then(res =>{
			if(mounted){
				if(res.data.status){

					setHistoryComments(res.data.list_history_comments);
				
				}
			}
		});



        return () => mounted = false;

	}, [baseUrlAPI]);

	return (
		<div className="zoom_modal" id="zoom_modal">
			
			<button className="close_zoom_modal" id="close_zoom_modal" onClick={handleCloseModal}>×</button>
			
			<div className="history_modal_content">
				{(historyComments.length>0)?
				<div className="history_modal_content_comments">
					<ul>
						<h2>التعليقات المؤرشفة</h2>

						<li className="border-bottom"></li>
						{historyComments.map((element, key)=>{
							return <li className="history_modal_content_comments_item" key={key}>
									<p>
										<span className="history_modal_name">{element.name}</span>
										<span className="history_modal_date">بتاريخ: {element.date}</span>
									</p>
									<p className="history_modal_text">{element.comment}</p>
								</li>
						
						})}
					</ul>
				</div>
				:<div className="history_modal_loading"><i className="fas fa-spinner"/></div>}
			</div>
		
		</div>
	);
};

export default HistoryModal;