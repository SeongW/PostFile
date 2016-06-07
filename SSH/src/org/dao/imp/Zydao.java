package org.dao.imp;

import org.model.ZybEntity;
import java.util.List;
/**
 * Created by wujiacheng on 16/6/5.
 */
public interface Zydao {
    //插入专业信息
    public void save(ZybEntity zy);
    //根据专业Id查找专业信息
    public ZybEntity getOneZy(int zyId);
    //查找所有专业信息
    public List getAll();

}
