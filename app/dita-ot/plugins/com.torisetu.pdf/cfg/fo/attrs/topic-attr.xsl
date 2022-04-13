<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:rx="http://www.renderx.com/XSL/Extensions"
    version="2.0">

    <xsl:attribute-set name="pre" use-attribute-sets="base-font common.block">
        <xsl:attribute name="white-space-treatment">preserve</xsl:attribute>
        <xsl:attribute name="white-space-collapse">false</xsl:attribute>
        <xsl:attribute name="linefeed-treatment">preserve</xsl:attribute>
        <xsl:attribute name="wrap-option">wrap</xsl:attribute>
        <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, MS mincho, Arial Unicode MS</xsl:attribute>
        <xsl:attribute name="line-height">100%</xsl:attribute>
    </xsl:attribute-set>

<!--Title (lv1) Hide-->
    <xsl:attribute-set name="topic.title.hide" use-attribute-sets="common.title common.border__bottom">
        <xsl:attribute name="border-after-width">0pt</xsl:attribute>
        <xsl:attribute name="space-before">0pt</xsl:attribute>
        <xsl:attribute name="space-after">15pt</xsl:attribute>
        <xsl:attribute name="font-size">2pt</xsl:attribute>
        <xsl:attribute name="font-weight">Regular</xsl:attribute>
        <xsl:attribute name="padding-top">0pt</xsl:attribute>
        <xsl:attribute name="keep-with-next.within-column">always</xsl:attribute>
        <xsl:attribute name="border-bottom">0pt solid black</xsl:attribute>
        <xsl:attribute name="color">#ffffff</xsl:attribute>
        <xsl:attribute name="line-hight">4pt</xsl:attribute>
    </xsl:attribute-set>

<!--Title (lv2) -->
    <!--<xsl:attribute-set name="topic.topic.title" use-attribute-sets="common.title common.title common.border__bottom">-->
    <xsl:attribute-set name="topic.topic.title" use-attribute-sets="common.title">
         <xsl:attribute name="padding-top">0pt</xsl:attribute>
         <xsl:attribute name="padding-bottom">2pt</xsl:attribute>
        <xsl:attribute name="border-top">3pt solid blue</xsl:attribute>
         <xsl:attribute name="border-after-width">1pt</xsl:attribute>
         <xsl:attribute name="border-after-color">blue</xsl:attribute>
        <xsl:attribute name="space-before">6pt</xsl:attribute>
        <xsl:attribute name="space-after">6pt</xsl:attribute>
        <xsl:attribute name="font-size">14pt</xsl:attribute>
        <xsl:attribute name="font-weight">Bold</xsl:attribute>
        <xsl:attribute name="keep-with-next.within-column">always</xsl:attribute>
    </xsl:attribute-set>

<!--Title (Lv3)-->
    <xsl:attribute-set name="topic.topic.topic.title" use-attribute-sets="common.title">
        <xsl:attribute name="border-bottom">1pt solid blue</xsl:attribute>
        <xsl:attribute name="border-left">2mm solid blue</xsl:attribute>
        <xsl:attribute name="space-before">6pt</xsl:attribute>
        <xsl:attribute name="space-after">6pt</xsl:attribute>
        <xsl:attribute name="font-size">12pt</xsl:attribute>
        <xsl:attribute name="font-weight">Regular</xsl:attribute>
        <xsl:attribute name="keep-with-next.within-column">always</xsl:attribute>
        <xsl:attribute name="start-indent">5pt</xsl:attribute>
    </xsl:attribute-set>

<!--Section Title-->
    <xsl:attribute-set name="section.title" use-attribute-sets="common.title">
        <xsl:attribute name="space-before">12pt</xsl:attribute>
        <xsl:attribute name="font-size">12pt</xsl:attribute>
        <xsl:attribute name="color">#990033</xsl:attribute>
        <xsl:attribute name="keep-with-next.within-column">always</xsl:attribute>
    </xsl:attribute-set>

<!--Pagebreak after Topic Lv2-->
    <xsl:attribute-set name="topic" use-attribute-sets="base-font">
    	<xsl:attribute name="page-break-after">always</xsl:attribute>
    </xsl:attribute-set>

<!--note__table indent-->
    <xsl:attribute-set name="note__table" use-attribute-sets="common.block">
        <xsl:attribute name="start-indent">5pt</xsl:attribute>
    </xsl:attribute-set>

<!--Note Container-->
    <xsl:attribute-set name="note__container" use-attribute-sets="common.block">
        <xsl:attribute name="border-bottom">1pt solid black</xsl:attribute>
        <xsl:attribute name="border-top">2pt solid black</xsl:attribute>
    </xsl:attribute-set>
    
<!--Note Label Container-->
    <xsl:attribute-set name="__note__label__size">
        <xsl:attribute name="width">20mm</xsl:attribute>
        <xsl:attribute name="content-width">scale-down-to-fit</xsl:attribute>
    </xsl:attribute-set> 
<!--Note ImageBox Container-->    
    <xsl:attribute-set name="__note__imagebox">
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set> 
    
<!---Note Text [POINT]-->    
    <xsl:attribute-set name="note__label__note">
    	<xsl:attribute name="font-weight">Bold</xsl:attribute>
    </xsl:attribute-set>

  <!--Image Dynamic Scaling-->
    <xsl:attribute-set name="image__block">
        <xsl:attribute name="content-width">scale-down-to-fit</xsl:attribute>
        <xsl:attribute name="content-hight">auto</xsl:attribute>        
        <xsl:attribute name="max-width">100%</xsl:attribute>
        <xsl:attribute name="scaling">uniform</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="image__inline">
        <xsl:attribute name="content-width">auto</xsl:attribute>
        <xsl:attribute name="content-hight">auto</xsl:attribute>
        <xsl:attribute name="width">auto</xsl:attribute>
        <xsl:attribute name="scaling">uniform</xsl:attribute>
    </xsl:attribute-set>  
        
</xsl:stylesheet>
