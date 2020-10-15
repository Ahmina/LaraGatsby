import React, {useState, useEffect, useCallback} from 'react';
import axios from 'axios';

const MainComments = (props) => {


    //Comments storage
    const [comments, setComments]=useState([]);    

    const getAllComments= useCallback(()=>{
        axios.get(`http://localhost:8001/api/post/${props.id}`)
        .then(res => 
            {    
                setComments(res.data);
            }
        );
    }, [props.id]);

    
    //DidMount.. to get api of comments..
    //The state:Comments change by the setState:setComments.. to do "map" for her.

    useEffect(()=>{

        getAllComments();

    }, [getAllComments]);


    return (
        <div>
                        
            <div className="main_blog_container main_blog_container_for-show-post">

                <div className="main_blog_container_prime frame_post_blog comment-part">

                    {/*---Display all comments of this post---*/}
                    <div className="comment_frame">
                        <div className="comment_frame_ul_b">
                            <div className="comment_numbres">
                                <span>التعليقات ({comments.length})</span>
                            </div>
                                                   
                        </div>
                        <ul className="comment_frame_ul">

                            {
                                comments.map(el=>{
                                    return(
                                        <li className="comment_element animateEntry" key={el.comment_id}>
                                            <b>{el.name}</b>
                                            <p>{el.comment}</p>
                                        </li>
                                    );       
                                })
                            }

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    );  
};

export default MainComments;