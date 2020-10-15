import React from 'react';


const MainPortfolio = (props) => {

    return (
        <main>
            <div className="main_global_container_grid">

                    {props.data.map(element => {
                        const data=element.node;
                        return(
                            <div key={data.id}>
                            <div className="main_global_container_grid_item">
                                <div className="title_site">
                                    {(data.star===true)?<span className="site_star site_star_left"><i className="fas fa-star"></i></span>:''}
                                    <span className="title_site_text">{data.title} - {data.date}</span>
                                    {(data.star===true)?<span className="site_star site_star_right"><i className="fas fa-star"></i></span>:''}
                                </div>
                                <div className="show_grid_container">
                                    <div className="show_description">
                                        <table className="description_table">
                                            <tbody>
                                                {data.table.map((cont, key)=>{
                                                    return(
                                                        <tr key={key}>
                                                            <td>{cont[0]}</td>
                                                            <td>{cont[1]}</td>
                                                        </tr>
                                                    );
                                                })}
                                                <tr key="fin">
                                                    <td>معاينة الموقع</td>
                                                    <td><a className="description_table_link" href={data.link} target="_blank" rel="noopener noreferrer">من هنا</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div className="show_img">
                                        <div className="show_container_button">
                                            <button className="showing_button">Show ({data.pics.length} images)</button>
                                            <a href={data.link} target="_blank" rel="noopener noreferrer" className="showing_button">Preview</a>
                                        </div>
                                        <img role="presentation" aria-hidden src={data.pics[0].publicURL} alt={data.title}/>
                                    </div>
                                </div>
                            </div>
                        
                            {/* This way to have all of the images/Links displayed... for SEO/archiving on Google */}
                            {data.pics.map((pic, key)=>{
                                return (<img src={pic.publicURL} alt={' صور لموقع '+data.title+' رقم '+key} key={key} className="image_zooming_img_hidden"/>);
                                
                            })}
                            {(data.id>2)?
                                <div className="main_global_container_grid_item_space">
                                    <div className="space_circle"></div>
                                    <div className="space_dashed_line"></div>
                                    <div className="space_circle space_circle_bottom"></div>
                                </div>:(+data.id===2)?
                                <div className="main_global_container_grid_item_space main_global_container_grid_item_space_plus">
                                    <div className="space_circle"></div>
                                    <div className="space_dashed_line space_dashed_line_plus"></div>
                                    <div className="space_circle space_circle_bottom space_circle_bottom_plus"></div>
                                </div>
                                :''
                            }

                            </div>
                        );
                        
                    })}

            </div>
	    </main>
    );
};

export default MainPortfolio;