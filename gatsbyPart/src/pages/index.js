import React from "react";
import "../style/main.css";
import HelmetComponent from "../components/HelmetComponent";
import Header from "../templates/Header";
import MainHome from "../mainComponents/MainHome";
import Footer from "../templates/Footer";


export default function Home() {

  let colorTitlesStyle={
    color: '#FFF'
  }
  return (
    <div>
      <HelmetComponent title="المدونة"/>
      <Header arrowActive="1" colorTitlesStyle={colorTitlesStyle} title1="مدونتي" title2="سأفتتحها لاحقاً.. شكراً على زيارتك"/>
      <MainHome/>
      <Footer />
    </div>)
}