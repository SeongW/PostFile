package org.dao;

import org.dao.imp.Cjdao;
import org.model.CjbEntity;
import org.model.CjbEntityPK;
import org.springframework.orm.hibernate4.support.HibernateDaoSupport;

import org.hibernate.*;

import java.util.List;

/**
 * Created by wujiacheng on 16/6/5.
 */
public class CjDaoImp extends HibernateDaoSupport implements Cjdao {
    @Override
    public void saveorupdateCj(CjbEntity cj) {
        getHibernateTemplate().saveOrUpdate(cj);
    }

    @Override
    public void deleteCj(String xh, String kch) {

        getHibernateTemplate().delete(getXsCj(xh, kch));
    }

    @Override
    public CjbEntity getXsCj(String xh, String kch) {
        CjbEntityPK cjbId=new CjbEntityPK();
        cjbId.setXh(xh);
        cjbId.setKch(kch);
        return (CjbEntity)getHibernateTemplate().get(CjbEntity.class, cjbId);

    }

    @Override
    public List findAllCj(int pageNow, int pageSize) {
        Session session=getHibernateTemplate().getSessionFactory().openSession();

        // ADD HERE
        session.setFlushMode(FlushMode.AUTO);


        Transaction ts=session.beginTransaction();
        Query query=session.createQuery("select c.id.xh,a.xm,b.kcm,c.cj,c.xf,c.id.kch from XsbEntity a,KcbEntity b,CjbEntity c where a.xh=c.id.xh and b.kch=c.id.kch");
        query.setFirstResult((pageNow-1)*pageSize);
        query.setMaxResults(pageSize);
        List list=query.list();
        ts.commit();
        session.close();
        return list;
    }

    @Override
    public List getXsCjList(String xh) {
        return getHibernateTemplate().find("select c.id.xh,a.xm,b.kcm,c.cj,c.xf from XsbEntity a,KcbEntity b,CjbEntity c where c.id.xh=? and a.xh=c.id.xh and b.kch=c.id.kch",xh);
    }

    @Override
    public List getKcCjList(String kch) {
        return getHibernateTemplate().find("from CjbEntity where kch=?",kch);
    }

    @Override
    public void deleteOneXsCj(String xh) {
        getHibernateTemplate().deleteAll(getXsCjList(xh));
    }

    @Override
    public void deleteOneKcInfo(String kch) {
        getHibernateTemplate().deleteAll(this.getKcCjList(kch));
    }

    @Override
    public int findCjSize() {
        return getHibernateTemplate().find("from CjbEntity").size();
    }
}
