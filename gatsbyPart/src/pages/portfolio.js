import React from "react";
import "../style/main.css";
import HelmetComponent from "../components/HelmetComponent";
import Header from "../templates/Header";
import MainPortfolio from "../mainComponents/MainPortfolio";
import Footer from "../templates/Footer";



export default function Porftolio() {

  let colorTitlesStyle={
    color: '#FFF'
  }
  return (
    <div>
      <HelmetComponent title="معرض الأعمال"/>
      <Header arrowActive="2" colorTitlesStyle={colorTitlesStyle} title1="الرحاب في معرض الأعمال" title2="معرض أعمال لرحلة تعلم وتطوير في الويب وتقنياته لأكثر من سبع سنوات"/>
      <MainPortfolio/>
      <Footer />
    </div>)
}