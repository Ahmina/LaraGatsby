import React from 'react';
import {Link} from 'gatsby';
import SecondMain from './SecondMain';


const MainHome = () => {

    return (
        <main>
            <div className="main_blog_container">
                <div className="main_blog_container_prime">

                            <Link  className="frame_post_blog frame_post_blog_link">
                                <h2>عنوان المقال جاتسبي</h2>
                                <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة ... هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة ...</p>
                                <div className="frame_post_blog_more">
                                    <span className="more_at_date">بتاريخ: nn-nn-nn</span>
                                    <span className="more_at_date more_author">حرره: المحرر</span>
                                </div>
                            </Link>
                            <Link  className="frame_post_blog frame_post_blog_link">
                                <h2>عنوان المقال جاتسبي</h2>
                                <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة ... هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة ...</p>
                                <div className="frame_post_blog_more">
                                    <span className="more_at_date">بتاريخ: nn-nn-nn</span>
                                    <span className="more_at_date more_author">حرره: المحرر</span>
                                </div>
                            </Link>
                            <Link  className="frame_post_blog frame_post_blog_link">
                                <h2>عنوان المقال جاتسبي</h2>
                                <p> هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة ... هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة ...</p>
                                <div className="frame_post_blog_more">
                                    <span className="more_at_date">بتاريخ: nn-nn-nn</span>
                                    <span className="more_at_date more_author">حرره: المحرر</span>
                                </div>
                            </Link>
                </div>
                <div className="main_blog_container_second">
                    <SecondMain />
                </div>
            </div>
	    </main>
    );
};


export default MainHome;