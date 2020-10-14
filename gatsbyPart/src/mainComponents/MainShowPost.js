import React from 'react';
import '../style/prism-vsc-dark-plus.css';

const MainShowPost = (props) => {


    return (
        <main>
            <div className="main_blog_container main_blog_container_for-show-post">
                <div className="main_blog_container_prime frame_post_blog">
                    <div className="blog-post-showing">
                        <div dangerouslySetInnerHTML={{ __html: props.post.html }} />
                    
                    </div>
                    
                    <div className="post_blog_infs">
                            <span className="flot-right"> حرره: {props.post.frontmatter.author}</span>
                            <span className="flot-left"> بتاريخ: {props.post.frontmatter.date}</span>
                    </div>
                          
                </div>
            </div>
	    </main>

    );




};



export default MainShowPost;