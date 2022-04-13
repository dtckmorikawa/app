<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

    <xsl:attribute-set name="__frontmatter">
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

<!--front matter title container-->
    <xsl:attribute-set name="__frontmatter__title__container">
        <xsl:attribute name="position">absolute</xsl:attribute>
        <xsl:attribute name="top">-15mm</xsl:attribute>
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__title" use-attribute-sets="common.title">
        <xsl:attribute name="space-before.conditionality">retain</xsl:attribute>
        <xsl:attribute name="font-size">18pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__sub__title" use-attribute-sets="common.title">
        <xsl:attribute name="space-before">36pt</xsl:attribute>
        <xsl:attribute name="font-size">12pt</xsl:attribute>
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>    

    
   <!--Product name on front page-->
    <xsl:attribute-set name="__frontmatter_productName">
            <xsl:attribute name="font-size">16pt</xsl:attribute>
            <xsl:attribute name="margin-bottom">5pt</xsl:attribute>
    </xsl:attribute-set>    

    <xsl:attribute-set name="__frontmatter__product">
        <xsl:attribute name="font-size">11pt</xsl:attribute>
        <xsl:attribute name="text-align">right</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__logo">
	<xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

   <xsl:attribute-set name="__front__logo__size">
	<xsl:attribute name="width">75mm</xsl:attribute>
        <xsl:attribute name="content-width">scale-down-to-fit</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__image">
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__link">
        <xsl:attribute name="font-size">12pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="text-align">right</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__logo__container">
        <xsl:attribute name="position">absolute</xsl:attribute>
        <xsl:attribute name="top">230mm</xsl:attribute>
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__image__container">
        <xsl:attribute name="position">absolute</xsl:attribute>
        <xsl:attribute name="top">0mm</xsl:attribute>
        <xsl:attribute name="text-align">center</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__subtitle" use-attribute-sets="common.title">
        <xsl:attribute name="font-size">18pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="line-height">140%</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__owner" use-attribute-sets="common.title">
        <xsl:attribute name="space-before">36pt</xsl:attribute>
        <xsl:attribute name="font-size">11pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="line-height">normal</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__owner__container">
        <xsl:attribute name="position">absolute</xsl:attribute>
        <xsl:attribute name="top">210mm</xsl:attribute>
        <xsl:attribute name="bottom">20mm</xsl:attribute>
        <xsl:attribute name="right">20mm</xsl:attribute>
        <xsl:attribute name="left">20mm</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__owner__container_content">
        <xsl:attribute name="text-align">center</xsl:attribute>
        <xsl:attribute name="content-width">50%</xsl:attribute>
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__mainbooktitle">
        <!--<xsl:attribute name=""></xsl:attribute>-->
    </xsl:attribute-set>

    <xsl:attribute-set name="__frontmatter__booklibrary">
        <!--<xsl:attribute name=""></xsl:attribute>-->
    </xsl:attribute-set>

  <xsl:attribute-set name="back-cover">
    <xsl:attribute name="force-page-count">end-on-even</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="__back-cover">
        <!--<xsl:attribute name="break-before">even-page</xsl:attribute>-->
  </xsl:attribute-set>
  
    <xsl:attribute-set name="backcover-container">
        <xsl:attribute name="position">absolute</xsl:attribute>
        <xsl:attribute name="text-align">left</xsl:attribute>
        <xsl:attribute name="top">220mm</xsl:attribute>
        <xsl:attribute name="left">100mm</xsl:attribute>
    </xsl:attribute-set>

  <xsl:attribute-set name="bookmap.summary">
    <xsl:attribute name="font-size">9pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="__backmatter__text">
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">normal</xsl:attribute>
  </xsl:attribute-set>
  
   <xsl:attribute-set name="__backmatter__text__bold">
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">bold</xsl:attribute>
    <xsl:attribute name="space-after">6pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="__backmatter__logo__container">
    <xsl:attribute name="position">absolute</xsl:attribute>
    <xsl:attribute name="top">210mm</xsl:attribute>
    <xsl:attribute name="left">97mm</xsl:attribute>
  </xsl:attribute-set>
  
     <xsl:attribute-set name="__back__address__logo__size">
	<xsl:attribute name="width">70mm</xsl:attribute>
        <xsl:attribute name="content-width">scale-down-to-fit</xsl:attribute>
    </xsl:attribute-set>

  <xsl:attribute-set name="__backmatter__copyright__container">
    <xsl:attribute name="position">absolute</xsl:attribute>
    <xsl:attribute name="top">245mm</xsl:attribute>
    <xsl:attribute name="text-align">right</xsl:attribute>
  </xsl:attribute-set>
  
   <xsl:attribute-set name="__backmatter__copyright">
    	 <xsl:attribute name="font-size">8pt</xsl:attribute>
        <xsl:attribute name="space-before">18pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="__backmatter__item">
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">bold</xsl:attribute>
    <xsl:attribute name="space-before">12pt</xsl:attribute>
    <xsl:attribute name="space-after">3pt</xsl:attribute>
    <xsl:attribute name="line-hight">14pt</xsl:attribute>
    <xsl:attribute name="text-align">right</xsl:attribute>
    <xsl:attribute name="color">#990033</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="back-cover">
    <!--<xsl:attribute name="force-page-count">end-on-even</xsl:attribute>-->
  </xsl:attribute-set>

  <xsl:attribute-set name="__back-cover">
    <!--<xsl:attribute name="break-before">even-page</xsl:attribute>-->
  </xsl:attribute-set>

</xsl:stylesheet>