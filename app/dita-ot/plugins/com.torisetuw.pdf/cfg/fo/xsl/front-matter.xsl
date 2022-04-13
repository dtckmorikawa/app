<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:opentopic="http://www.idiominc.com/opentopic"
    exclude-result-prefixes="opentopic"
    version="2.0">

    <xsl:template name="createFrontMatter">
      <xsl:if test="$generate-front-cover">
        <fo:page-sequence master-reference="front-matter" xsl:use-attribute-sets="page-sequence.cover">
            <xsl:call-template name="insertFrontMatterStaticContents"/>
            <fo:flow flow-name="xsl-region-body">
              <fo:block-container xsl:use-attribute-sets="__frontmatter">
                <xsl:call-template name="createFrontCoverContents"/>
              </fo:block-container>
            </fo:flow>
        </fo:page-sequence>
      </xsl:if>
    </xsl:template>

<!--Front Cover Starts From Here-->
<!--Front Cover Starts From Here-->
<!--Front Cover Starts From Here-->
<!--Front Cover Starts From Here-->

  <xsl:template name="createFrontCoverContents">
    <!--Front Cover Image-->
    <fo:block-container xsl:use-attribute-sets="__frontmatter__image__container">
      <fo:block xsl:use-attribute-sets="__frontmatter__image">
          <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/FrontCover.jpg)"/>
      </fo:block>
    </fo:block-container>
  
    <!-- title -->
    <fo:block-container xsl:use-attribute-sets="__frontmatter__title__container">
    	<fo:block xsl:use-attribute-sets="__frontmatter__title">
	      <fo:block><xsl:value-of select="$bc.bookTitle"/></fo:block>
    	</fo:block>
    	<fo:block xsl:use-attribute-sets="__frontmatter__sub__title">
	      <fo:block><xsl:value-of select="$bc.shortDesc"/></fo:block>
    	</fo:block>      
    </fo:block-container>

    <!-- link at bottom -->
    <fo:block-container xsl:use-attribute-sets="__frontmatter__logo__container">
      <fo:block xsl:use-attribute-sets="__frontmatter__link">
          <fo:basic-link external-destination="http://192.168.3.189:8080/morikawa/dita-test/public/">Created with Dita-OT</fo:basic-link>
      </fo:block>
    </fo:block-container>

  </xsl:template>

<!-- back cover starts from here -->
<!-- back cover starts from here -->
<!-- back cover starts from here -->
<!-- back cover starts from here -->
  <xsl:template name="createBackCover">
      <xsl:if test="$generate-back-cover">
        <fo:page-sequence master-reference="back-cover" xsl:use-attribute-sets="back-cover">
          <xsl:call-template name="insertBackCoverStaticContents"/>
          <fo:flow flow-name="xsl-region-body">
            <fo:block-container xsl:use-attribute-sets="__back-cover">
              <xsl:call-template name="createBackCoverContents"/>
            </fo:block-container>
          </fo:flow>
        </fo:page-sequence>
      </xsl:if>
    </xsl:template>
    
<!-- Back Cover Template -->
    <xsl:template name="createBackCoverContents">
      	<!--Company name logo-->
      	<fo:block-container xsl:use-attribute-sets="__backmatter__logo__container">
      		<fo:block>
        		<!--<fo:external-graphic src="url(Customization/OpenTopic/common/artwork/front_logo.png)" xsl:use-attribute-sets="__back__address__logo__size"/>-->
        	</fo:block>
      	</fo:block-container>
      	<!--Company Address-->
    	<fo:block-container xsl:use-attribute-sets="backcover-container">
      		 	<fo:block xsl:use-attribute-sets="__backmatter__text__bold">
        			<xsl:text>Made by DITA-OT Web System</xsl:text>
      			</fo:block>
      	</fo:block-container>
    </xsl:template>

</xsl:stylesheet>