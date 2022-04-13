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
          <fo:external-graphic src="url(Customization/OpenTopic/common/artwork/FrontMatterSample.jpg)"/>
      </fo:block>
    </fo:block-container>
  
    <!-- title -->
    <fo:block-container xsl:use-attribute-sets="__frontmatter__title__container">
    	<fo:block xsl:use-attribute-sets="__frontmatter__title">
 	      <fo:block><xsl:value-of select="$bc.bookTitle"/></fo:block>
    	</fo:block>
    </fo:block-container>

    <!--logo and link
    <fo:block-container xsl:use-attribute-sets="__frontmatter__logo__container">
      <fo:block xsl:use-attribute-sets="__frontmatter__logo">
        	<fo:external-graphic src="url(Customization/OpenTopic/common/artwork/front_logo.png)" xsl:use-attribute-sets="__front__logo__size"/>
      </fo:block>
    </fo:block-container>-->

    <!-- set the subtitle -->
    <xsl:apply-templates select="$map//*[contains(@class,' bookmap/booktitlealt ')]"/>
    <fo:block xsl:use-attribute-sets="__frontmatter__owner">
      <xsl:apply-templates select="$map//*[contains(@class,' bookmap/bookmeta ')]"/>
    </fo:block>

    <!-- Manual Number-->
   <fo:block xsl:use-attribute-sets="__frontmatter__product">
        <!--<xsl:value-of select="$bc.productName"/><xsl:text>: </xsl:text>-->
        <!--<fo:block>&#xA0;</fo:block>line break-->
        <!--<xsl:value-of select="$bc.productVersion"/>-->
        <!--<fo:block>
        	<xsl:text>MANUAL No.  </xsl:text>
        	<xsl:call-template name="getVariable">
        		<xsl:with-param name="id" select="'Manual Number'"/>
        	</xsl:call-template>
        </fo:block>
        <fo:block>
        	<xsl:text>Published in  </xsl:text>
        	<xsl:call-template name="getVariable">
        		<xsl:with-param name="id" select="'Published date'"/>
        	</xsl:call-template>
        </fo:block>
        <fo:block>
        	<xsl:text>Revised in  </xsl:text>
        	<xsl:call-template name="getVariable">
        		<xsl:with-param name="id" select="'Revised date'"/>
        	</xsl:call-template>
        </fo:block>-->
    </fo:block>
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

<!--Normal Blank BackCover -->
  <xsl:template name="createBackCoverContents">
	 	<fo:block xsl:use-attribute-sets="__backmatter__text__bold">
		</fo:block>
  </xsl:template>

<!-- Back Cover Template
    <xsl:template name="createBackCoverContents">-->
      	<!--Company name logo
      	<fo:block-container xsl:use-attribute-sets="__backmatter__logo__container">
      		<fo:block>
        		<fo:external-graphic src="url(Customization/OpenTopic/common/artwork/front_logo.png)" xsl:use-attribute-sets="__back__address__logo__size"/>
        	</fo:block>
      	</fo:block-container>-->
      	<!--Company Address
    	<fo:block-container xsl:use-attribute-sets="backcover-container">
      		 	<fo:block xsl:use-attribute-sets="__backmatter__text__bold">
        			<xsl:text>広島工場</xsl:text>
      			</fo:block>
      		 	<fo:block xsl:use-attribute-sets="__backmatter__text">
        			<xsl:text>〒739-0153  広島県東広島市吉川工業団地 4-22 </xsl:text>
      			</fo:block>
      		 	<fo:block xsl:use-attribute-sets="__backmatter__text">
        			<xsl:text>TEL. (082) 429-1118(代)   FAX. (082) 429-0804 </xsl:text>
      			</fo:block>
      		      <fo:block xsl:use-attribute-sets="__backmatter__text">
        			<xsl:text>[サービス部] E-mail : service@sst.laravel.co.jp </xsl:text>
      			</fo:block>
      	</fo:block-container>
      	<fo:block-container xsl:use-attribute-sets="__backmatter__copyright__container">
      		<fo:block xsl:use-attribute-sets="__backmatter__copyright">
        		<xsl:text>&#169;  2014 laravel Sensor Technology, Inc. All rights reserved. </xsl:text>
      		</fo:block>
      	</fo:block-container>
    </xsl:template>-->

</xsl:stylesheet>